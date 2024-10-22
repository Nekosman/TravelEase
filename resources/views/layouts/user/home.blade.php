@extends('layouts.user.sidebar')

@section('title', 'Dashboard')

@section('contents')
<link href="{{ asset('assets/css/dashboardcs.css') }}" rel="stylesheet">

<div class="promo-section">
    <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
    <h3>Special Promo for TravelEase!</h3>
    <div class="bali-promo">
        <h2>Explore Bali!</h2>
        <p>Book your dream vacation in Bali and get an additional 10% off. Use code <strong>BALI10</strong> at checkout!</p>
        <img src="images/bali.jpg" alt="" />
    </div>
</div>

<style>
    .promo-section {
        background-color: #f5f8fa; /* Light background for the promo section */
        border: 2px solid #007bff; /* Blue border */
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px; /* Space between the promo and chatbot */
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a slight shadow for depth */
        position: relative; /* For positioning the close button */
    }

    .close-button {
        position: absolute; /* Position the button */
        top: 10px; /* Distance from the top */
        right: 15px; /* Distance from the right */
        background: none; /* No background */
        border: none; /* No border */
        font-size: 20px; /* Size of the 'X' */
        color: #333; /* Color of the 'X' */
        cursor: pointer; /* Change cursor to pointer */
        transition: color 0.3s; /* Smooth transition for hover effect */
    }

    .close-button:hover {
        color: #ff5722; /* Change color on hover */
    }

    .promo-section h2 {
        color: #007bff; /* Same blue as the border */
        font-size: 24px; /* Increased font size */
        margin-bottom: 10px;
        font-weight: 600; /* Semi-bold */
    }

    .promo-section p {
        font-size: 16px; /* Increased font size */
        color: #333; /* Darker text for readability */
        margin-bottom: 15px; /* Add space below the paragraph */
    }

    .promo-section strong {
        color: #ff5722; /* Highlighted color for the promo code */
        font-weight: bold;
    }

    .bali-promo img {
        width: 100%; /* Responsive image */
        max-width: 400px; /* Max width for larger screens */
        height: auto;
        border-radius: 8px; /* Rounded corners for the image */
        margin: 15px 0; /* Space around the image */
    }

    .promo-button {
        display: inline-block;
        background-color: #007bff; /* Button background color */
        color: white; /* Button text color */
        padding: 10px 20px; /* Button padding */
        border-radius: 5px; /* Rounded corners */
        text-decoration: none; /* Remove underline */
        font-size: 16px;
        transition: background-color 0.3s; /* Smooth transition for hover effect */
        margin-top: 10px; /* Space above the button */
    }

    .promo-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    .container5 {
        margin-top: 20px; /* Space above the report section */
    }

    .report-item {
        border: 1px solid #e0e0e0; /* Light border for report items */
        border-radius: 8px; /* Rounded corners */
        padding: 15px; /* Padding for report items */
        margin-bottom: 15px; /* Space between report items */
        background-color: #fff; /* White background for report items */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08); /* Subtle shadow */
    }

    .report-title {
        font-weight: bold; /* Bold title */
        color: #007bff; /* Blue color for titles */
    }

    .report-date {
        color: #777; /* Grey color for the date */
        font-size: 12px; /* Smaller font size for the date */
    }
</style>

<div class="container5">
    <h1>Laporan Dalam Antrean</h1>
    <br>
    @forelse ($tickets as $ticket)
        <div class="report-item">
            <div class="report-details">
                <p class="report-title">Ticket {{ $ticket->title }} From {{ $ticket->user->name }}</p>
                <p class="report-description">Description: {{ $ticket->description }}</p>
                <span class="report-date">{{ $ticket->created_at->format('d F Y H:i') }}</span> 
            </div>
        </div>
    @empty
        <p>Tidak ada laporan dalam antrean.</p>
    @endforelse
    <hr>
</div>

@include('chatbot.chatbot')

@endsection
