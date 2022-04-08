<?php

namespace Illuminate\View;

class ViewName
{
    /**
     * Normalize the given view name.
     *
     * @param  string  $name
     * @return string
     */
    public static function normalize($name)
    {
        $delimiter = ViewFinderInterface::HINT_PATH_DELIMITER;

<<<<<<< HEAD
        if (! str_contains($name, $delimiter)) {
=======
        if (strpos($name, $delimiter) === false) {
>>>>>>> origin/New-FakeMain
            return str_replace('/', '.', $name);
        }

        [$namespace, $name] = explode($delimiter, $name);

        return $namespace.$delimiter.str_replace('/', '.', $name);
    }
}
