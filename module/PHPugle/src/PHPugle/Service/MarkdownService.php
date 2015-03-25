<?php
/**
 * @author benwillems
 * @date 25-03-15
 * @namespace PHPugle\Service;
 */

namespace PHPugle\Service;


class MarkdownService extends AbstractService {

    public function parseMarkdown($content, $filename = false) {
        $params = array();
        if ($filename !== false) {
            $filename = basename($filename);
            if (preg_match('/[\d]{4}-[\d]{2}-[\d]{2}/', $filename, $matches)) {
                $params["date"] = date("d F Y", strtotime($matches[0]));
                $url = preg_replace('/([\d]{4})-([\d]{2})-([\d]{2})-/', '\1/\2/\3/', $filename);
                $url = preg_replace('/\\.[^.\\s]{2,4}$/', '', $url);
                $params["url"] = "/".$url;
            }
        }
        if (preg_match('/^---(.+)---/is', $content, $matches)) {
            $content = preg_replace('/^---(.+)---/is', "", $content);
            if ($matches[1]) {
                $lines = explode(PHP_EOL, $matches[1]);
                foreach ($lines as $line) {
                    if (strpos($line, ":") !== false) {
                        $lineArr = array_map("trim", explode(":", $line, 2));
                        if (sizeof($lineArr) == 2 && !isset($params[$lineArr[0]])) {
                            $params[$lineArr[0]] = $lineArr[1];
                        }
                    }
                }
            }
        }
        $params["html"] = $this->getServiceLocator()->get("ciconia")->render($content);
        return $params;
    }

    public function parseMarkdownFile($filename = false) {
        $content = "";
        if ($filename !== false && file_exists($filename)) {
            ob_start();
            include $filename;
            $content = ob_get_clean();
        }
        return $this->parseMarkdown($content, $filename);
    }

}