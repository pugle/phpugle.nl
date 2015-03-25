<?php
/**
 * @author benwillems
 * @date 25-03-15
 * @namespace PHPugle\Controller;
 */

namespace PHPugle\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $postfiles = array_reverse(glob(getcwd()."/data/_posts/*.md"));
        $posts = array();
        $navigation = array("Meetings" => "http://meetup.phpugle.nl");
        foreach ($postfiles as $postfile) {
            $posts[] = $this->getServiceLocator()->get("markdownService")->parseMarkdownFile($postfile);
        }
        return $this->renderView(array("posts" => $posts, "navigation" => $navigation), "index");
    }

    public function postAction() {
        $navigation = array("Meetings" => "http://meetup.phpugle.nl");
        if($post_url = $this->getEvent()->getRouteMatch()->getParam("post_url", false)) {
            $filename = str_replace("/", "-", $post_url);
            $postfile = getcwd()."/data/_posts/".$filename.".md";
            if (file_exists($postfile)) {
                $post = $this->getServiceLocator()->get("markdownService")->parseMarkdownFile($postfile);
                return $this->renderView(array("title" => $post["title"], "post" => $post, "navigation" => $navigation), "post");
            }
        }
    }

    /**
     * This function is a helper to create the appropriate view based on the desired template
     * and requested format (html or json). Format is based on the HTTP Accept headers
     *
     * @param array $array:	Array with values directly passed to the view, usable as $this in the template files
     * @param string $template: The name of  the desired template, will be matched agains html/template or json/template
     * @return ViewModel $view: The created ViewModel
     */
    public function renderView($array = array(), $template, $layout = 'layout/html') {
        // Setup the default view
        $view = new ViewModel($array);
        $this->layout($layout);

        $view->setTemplate('md/'.$template);

        $headers = $this->getRequest()->getHeaders();
        if($headers->has('accept')) {
            // This return the JSON response
            $accept = $headers->get('Accept');
            $match = $accept->match('application/json');
            if($match = $accept->match('application/json') && $match->getTypeString() != "*/*") {
                // Render the HTML into variable
                $renderer = $this->getServiceLocator()->get('ViewRenderer');
                $html = $renderer->render($view);

                $view = new ViewModel(array_merge($array, array("html" => $html)));

                $this->layout('layout/json');
                $view->setTemplate('json/'.$template);

                // Add appropiate JSON content type headers
                $this->getResponse()->getHeaders()->addHeaderLine('Content-Type', 'application/json; charset=utf-8');
                return $view;
            }
        }
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        $html = $renderer->render($view);

        $params = $this->getServiceLocator()->get("markdownService")->parseMarkdown($html);
        $params["asset_path"] = "/themes/bootstrap-3";
        $params["navigation"] = $array["navigation"];
        $config = $this->getServiceLocator()->get("config");
        $params["app_title"] = $config["application"]["title"];
        $params = array_merge($array, $params);


        $view = new ViewModel($params);
        $this->layout($layout);
        $view->setTemplate('html/index');
        $this->getResponse()->getHeaders()->addHeaderLine('Content-Type', 'text/html; charset=utf-8');

        return $view;
    }

}