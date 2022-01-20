<?php

class Renderer
{
    public static function render($file, $dir): void
    {
        $filename = basename($file, '.phtml');
        ob_start();

        include $file;

        $output = ob_get_clean();

        $output = static::removeWhitespace($output);
        $output = static::removeComments($output);

        file_put_contents("$dir/$filename.html", trim($output));
    }

    private static function removeWhitespace($output): string
    {
        // Trim off whitespace between elements (before any left angle bracket)
        // of an opening tag or a closing tag
        $output = preg_replace( '/>\s+</', "><", $output);

        // Trim excess whitespace like newlines and tabs down to a single space
        $output = preg_replace( '/\s\s+/', " ", $output);

        // Trim spaces from multi-lined elements
        return preg_replace_callback('/(<\w+[^>]*>)(.+?)(<\/\w+>)/', function ($matches) {
            return $matches[1].trim($matches[2]).$matches[3];
        }, $output);
    }

    private static function removeComments($output): string
    {
        return preg_replace('/<!--(.|\s)*?-->/', "", $output);
    }

}
