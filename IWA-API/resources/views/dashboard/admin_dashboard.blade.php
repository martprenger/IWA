<!-- Onscrollbare pagina -->
<style>body{ overflow:hidden;}</style>

@php
    use App\Models\User;
    class Geolocation extends \App\Models\Geolocation{}

    $backgroundImages = [
        asset('images/adminwallpaper1.png'),
        asset('images/adminwallpaper2.jpg'),
        asset('images/adminwallpaper3.jpg'),
        asset('images/adminwallpaper4.jpg'),
        asset('images/adminwallpaper5.jpg'),
    ];

    $selectedBackground = $backgroundImages[array_rand($backgroundImages)];

           $geolocations = Geolocation::all();
           $totalCount = count($geolocations->pluck('station_name')->unique());
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

<div class="container-fluid" style="background-image: url('{{ $selectedBackground }}'); background-size: cover; height: 100vh;">
    <div class="text-with-shadow" style="padding-top: 50px; font-family: 'Arial Black' ,serif; font-size: 50px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">{{ $greeting }} {{ ucwords(Auth::user()->name) }}</div>
    <div class="row justify-content-center align-items-center h-50">
        <div class="col-md-3 col-sm-3" style="margin-right: 100px;">
            <div class="text-with-shadow" style="font-family: 'Arial Black' ,serif; font-size: 100px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"> {{ $totalCount }} </div>
            <div class="text-with-shadow" style="font-family: 'Arial Black' ,serif; font-size: 50px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Actieve Weerstations</div>
        </div>
        <div class="col-md-3 col-sm-3" style="margin-left: 100px;">
            <div class="text-with-shadow" style="font-family: 'Arial Black',serif; font-size: 100px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">{{ User::count()  }}</div>
            <div class="text-with-shadow" style="font-family: 'Arial Black',serif; font-size: 50px; text-align: center; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Actieve Gebruikers</div>
        </div>
    </div>
</div>
