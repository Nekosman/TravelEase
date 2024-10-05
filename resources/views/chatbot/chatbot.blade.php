@extends('layouts.user.sidebar')

@section('contents')
<div id="chatbot"></div>
<script>
    var botmanWidget = {
        frameEndpoint: '/botman/chat',
        introMessage: 'Halo! Ada yang bisa saya bantu?',
        placeholderText: 'Ketik pesan Anda...',
        chatServer: '/botman',
        title: 'Bot Chat'
    };
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endsection