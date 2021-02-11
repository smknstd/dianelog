<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Filesystem\FilesystemManager;

class DownloadPdfController extends Controller
{
    public function download(Post $post, FilesystemManager $fileSystem)
    {
        abort_if(!$post->pdf, 404);

        return $fileSystem
            ->disk("local")
            ->download(
                $post->pdf->file_name
            );
    }
}
