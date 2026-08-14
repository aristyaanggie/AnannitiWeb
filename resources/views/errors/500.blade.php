@php
    $errorCode = 500;
    $errorTitle = 'Server Error';
    $errorMessage = 'Terjadi kesalahan pada server. Coba lagi beberapa saat lagi.';
    $errorHint = 'We are working on fixing this. Please try again later.';
@endphp

@extends('errors.layout', [
    'errorCode' => $errorCode,
    'errorTitle' => $errorTitle,
    'errorMessage' => $errorMessage,
    'errorHint' => $errorHint,
])
