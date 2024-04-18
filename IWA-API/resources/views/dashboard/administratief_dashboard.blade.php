<!-- Onscrollbare pagina -->
<style>body{ overflow:hidden;}</style>

@php
    use App\Models\Klant;
    use App\Models\Contracten;

    class Geolocation extends \App\Models\Geolocation{}

           $currentTime = date('H'); // Get the current hour in 24-hour format
           $greeting = ''; // Initialize the greeting variable

           if ($currentTime >= 5 && $currentTime < 12) {
               $greeting = 'Goedemorgen';
           } elseif ($currentTime >= 12 && $currentTime < 18) {
               $greeting = 'Goedemiddag';
           } else {
               $greeting = 'Goedenavond';
           }
@endphp

<div class="container-fluid" style="background-image: url('{{ asset('images/adminwallpaper4.jpg') }}'); background-size: cover; height: 100vh;">
    <div class="text-with-shadow " style="padding-top: 50px; font-family: 'Arial Black' ,serif; font-size: 50px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">{{ $greeting }} {{ ucwords(Auth::user()->name) }}</div>
    <div class="row justify-content-center align-items-center h-50">
        <div class="col-md-3 col-sm-3" style="margin-right: 100px;">
            <div class="text-with-shadow" style="font-family: 'Arial Black' ,serif; font-size: 100px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"> {{ Contracten::count() }} </div>
            <div class="text-with-shadow" style="font-family: 'Arial Black' ,serif; font-size: 50px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Contracten</div>
        </div>
        <div class="col-md-3 col-sm-3" style="margin-left: 100px;">
            <div class="text-with-shadow" style="font-family: 'Arial Black',serif; font-size: 100px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">{{ Klant::count() }}</div>
            <div class="text-with-shadow" style="font-family: 'Arial Black',serif; font-size: 50px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Klanten</div>
        </div>
    </div>
</div>
