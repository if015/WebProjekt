<?php

//MIME-Type als Icon anzeigen

function showMime($path) {
    $mime = mime_content_type($path);

    switch($mime) {
        case "application/gzip";
            echo "<span class='fa fa-file-archive-o'></span>";
            break;
        case "application/javascript";
            echo "<span class='fa fa-file-code-o'></span>";
            break;
        case "application/msexcel";
            echo "<span class='fa fa-file-excel-o'></span>";
            break;
        case "application/mspowerpoint";
            echo "<span class='fa fa-file-powerpoint-o'></span>";
            break;
        case "application/msword";
            echo "<span class='fa fa-file-word-o'></span>";
            break;
        case "application/pdf";
            echo "<span class='fa fa-file-pdf-o'></span>";
            break;
        case "application/rtf";
            echo "<span class='fa fa-file-text-o'></span>";
            break;
        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            echo "<span class='fa fa-file-excel-o'></span>";
            break;
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            echo "<span class='fa fa-file-word-o'></span>";
            break;
        case "application/xhtml+xml";
            echo "<span class='fa fa-file-code-o'></span>";
            break;
        case "application/x-compress";
            echo "<span class='fa fa-file-archive-o'></span>";
            break;
        case "application/x-gtar";
            echo "<span class='fa fa-file-archive-o'></span>";
            break;
        case "application/x-tar";
            echo "<span class='fa fa-file-archive-o'></span>";
            break;
        case "application/zip";
            echo "<span class='fa fa-file-archive-o'></span>";
            break;
        case "audio/x-midi";
            echo "<span class='fa fa-file-audio-o'></span>";
            break;
        case "audio/x-mpeg";
            echo "<span class='fa fa-file-audio-o'></span>";
            break;
        case "audio/x-wav";
            echo "<span class='fa fa-file-audio-o'></span>";
            break;
        case "image/gif";
            echo "<span class='fa fa-file-image-o'></span>";
            break;
        case "image/jpeg";
            echo "<span class='fa fa-file-image-o'></span>";
            break;
        case "image/png";
            echo "<span class='fa fa-file-image-o'></span>";
            break;
        case "image/tiff";
            echo "<span class='fa fa-file-image-o'></span>";
            break;
        case "image/x-icon";
            echo "<span class='fa fa-file-image-o'></span>";
            break;
        case "text/comma-separated-values";
            echo "<span class='fa fa-file-code-o'></span>";
            break;
        case "text/css";
            echo "<span class='fa fa-file-code-o'></span>";
            break;
        case "text/html";
            echo "<span class='fa fa-file-code-o'></span>";
            break;
        case "text/javascript";
            echo "<span class='fa fa-file-code-o'></span>";
            break;
        case "";
            echo "<span class='fa '></span>";
            break;
        case "text/plain";
            echo "<span class='fa fa-file-text-o'></span>";
            break;
        case "text/richtext";
            echo "<span class='fa fa-file-text-o'></span>";
            break;
        case "text/rtf";
            echo "<span class='fa fa-file-text-o'></span>";
            break;
        case "video/mpeg";
            echo "<span class='fa fa-file-video-o'></span>";
            break;
        case "video/quicktime";
            echo "<span class='fa fa-file-video-o'></span>";
            break;
        case "video/x-msvideo";
            echo "<span class='fa fa-file-video-o'></span>";
            break;

        default:
            echo "<span class='fa fa-file-o'></span>";
    }
}

