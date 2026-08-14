@php
    $errorCode = 429;
    $errorTitle = 'Too Many Requests';
    $errorMessage = 'Terlalu banyak percobaan. Tunggu sebentar lalu coba lagi.';
    $errorHint = 'Slow down and try again in a minute.';
@endphp

@extends('errors.layout', [
    'errorCode' => $errorCode,
    'errorTitle' => $errorTitle,
    'errorMessage' => $errorMessage,
    'errorHint' => $errorHint,
])
