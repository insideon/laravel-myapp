<?php

namespace App;

use File;

class Documentation
{
    public function get($file = 'documentation.md')
    {
        $content = File::get($this->path($file));

        return $this->replaceLinks($content);
    }

    public function image($file)
    {
        return \Image::make($this->path($file, 'docs/images'));
    }

    protected function path($file, $dir = 'docs')
    {
        $file = ends_with($file, ['.md', '.png']) ? $file : $file . '.md';
        $path = base_path($dir . DIRECTORY_SEPARATOR . $file);

        if (! File::exists($path)) {
            abort(404, trans('docs.messages.not_found'));
        }

        return $path;
    }

    protected function replaceLinks($content)
    {
        return str_replace('/docs/{{version}}', '/docs', $content);
    }

    public function etag($file)
    {
        $lastModified = File::lastModified($this->path($file, 'docs/images'));
        return md5($file . $lastModified);
    }
}
