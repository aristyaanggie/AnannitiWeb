@php
    $errorCode = 404;
    $errorTitle = 'Page Not Found';
    $errorMessage = 'Halaman yang kamu cari tidak ditemukan atau sudah dipindahkan.';
    $errorHint = 'Check the URL or head back to the homepage.';
@endphp

@extends('errors.layout', [
    'errorCode' => $errorCode,
    'errorTitle' => $errorTitle,
    'errorMessage' => $errorMessage,
    'errorHint' => $errorHint,
])
