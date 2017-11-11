@extends('manager.manager')
@section('content')
    <p>Click on the map to add A and B points, drag the points to change the places.</p>

    <div id="map-holder"></div>
    <div id="text-holder"></div>
    <form action="/sdfsdf">
        <input type="text" name="A" id="address-a" placeholder="Address 1" required />
        <input type="text" name="B" id="address-b" placeholder="Address 2" required />
        <input type="text" name="distance" id="distance" disabled required />
        <input type="text" name="time" id="time" disabled required />
        <div>
            <input type="submit" value="Send data"/>
        </div>
    </form>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        p {
            font-size: 14px;
            color: #333;
            line-height: 30px;
            padding: 0 5px;
        }

        #map-holder {
            height: 400px;
            width: 100%;
        }
    </style>
    <script type='text/javascript'>
        var onMapLoad = function () {
            var textHolderDomEl = document.getElementById('text-holder'),
                addressInputA = document.getElementById('address-a'),
                addressInputB = document.getElementById('address-b'),
                distanceInput = document.getElementById('distance'),
                timeInput = document.getElementById('time'),
                route = new routeControl({
                    mapDomEl: document.getElementById('map-holder'),
                    center: {
                        lat: 42.8489128, // Gabrovo, Bulgaria
                        lng: 25.255236
                    },
                    onRouteSuccess: function (routeData) {
                        addressInputA.value = routeData.addressA || "";
                        addressInputB.value = routeData.addressB || "";
                        distanceInput.value = routeData.distance.text || "";
                        timeInput.value = routeData.time || "";
                        textHolderDomEl.innerHTML = "";
                    },
                    onRouteFail: function () {
                        var html = [
                            "<p class='error'>Cannot calculate route.</p>",
                            "<p class='error'>Please select another points.</p>"
                        ].join('');

                        addressInputA.value = "";
                        addressInputB.value = "";
                        distanceInput.value = "";
                        timeInput.value = "";
                        textHolderDomEl.innerHTML = html;
                    }
                });

            var onAddressChange = function (pointIndex, event) {
                route.setAddress(event.target.value, pointIndex);
            }

            addressInputA.addEventListener('blur', onAddressChange.bind(null, route.pointIndexes.A));
            addressInputB.addEventListener('blur', onAddressChange.bind(null, route.pointIndexes.B));
        }
    </script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/routeControl.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=onMapLoad&region=BG&key=AIzaSyDJ8-74q6kLtxWZ5egVzUwVzwSkKQiGvzQ"></script>
@endsection

