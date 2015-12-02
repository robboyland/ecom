@extends('layouts.default')

@section('content')
    <div class="col-md-6 col-md-offset-1">
        <h1>Your Details</h1>

        <form action="" method="POST">
            <div class="form-group">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">password_confirmation</label>
                    <input type="text" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
            </div>

            <h2>Billing &amp; Delivery Address</h2>

            <div class="form-group">

                <div class="form-group">
                    <label for="name-number">name-number</label>
                    <input type="text" name="name-number" value="{{ old('name-number') }}" id="name-number" class="form-control">
                </div>

                <div class="form-group">
                    <label for="street">street</label>
                    <input type="text" name="street" value="{{ old('street') }}" id="street" class="form-control">
                </div>

                <div class="form-group">
                    <label for="city-town">city-town</label>
                    <input type="text" name="city-town" value="{{ old('city-town') }}" id="city-town" class="form-control">
                </div>

                <div class="form-group">
                    <label for="county">county</label>
                    <select name="Counties"class="form-control">
                    <optgroup label="England">
                        <option>Bedfordshire</option>
                        <option>Berkshire</option>
                        <option>Bristol</option>
                        <option>Buckinghamshire</option>
                        <option>Cambridgeshire</option>
                        <option>Cheshire</option>
                        <option>City of London</option>
                        <option>Cornwall</option>
                        <option>Cumbria</option>
                        <option>Derbyshire</option>
                        <option>Devon</option>
                        <option>Dorset</option>
                        <option>Durham</option>
                        <option>East Riding of Yorkshire</option>
                        <option>East Sussex</option>
                        <option>Essex</option>
                        <option>Gloucestershire</option>
                        <option>Greater London</option>
                        <option>Greater Manchester</option>
                        <option>Hampshire</option>
                        <option>Herefordshire</option>
                        <option>Hertfordshire</option>
                        <option>Isle of Wight</option>
                        <option>Kent</option>
                        <option>Lancashire</option>
                        <option>Leicestershire</option>
                        <option>Lincolnshire</option>
                        <option>Merseyside</option>
                        <option>Middlesex</option>
                        <option>Norfolk</option>
                        <option>North Yorkshire</option>
                        <option>Northamptonshire</option>
                        <option>Northumberland</option>
                        <option>Nottinghamshire</option>
                        <option>Oxfordshire</option>
                        <option>Rutland</option>
                        <option>Shropshire</option>
                        <option>Somerset</option>
                        <option>South Yorkshire</option>
                        <option>Staffordshire</option>
                        <option>Suffolk</option>
                        <option>Surrey</option>
                        <option>Tyne and Wear</option>
                        <option>Warwickshire</option>
                        <option>West Midlands</option>
                        <option>West Sussex</option>
                        <option>West Yorkshire</option>
                        <option>Wiltshire</option>
                        <option>Worcestershire</option>
                    </optgroup>
                    <optgroup label="Scotland">
                        <option>Aberdeenshire</option>
                        <option>Angus</option>
                        <option>Argyllshire</option>
                        <option>Ayrshire</option>
                        <option>Banffshire</option>
                        <option>Berwickshire</option>
                        <option>Buteshire</option>
                        <option>Cromartyshire</option>
                        <option>Caithness</option>
                        <option>Clackmannanshire</option>
                        <option>Dumfriesshire</option>
                        <option>Dunbartonshire</option>
                        <option>East Lothian</option>
                        <option>Fife</option>
                        <option>Inverness-shire</option>
                        <option>Kincardineshire</option>
                        <option>Kinross</option>
                        <option>Kirkcudbrightshire</option>
                        <option>Lanarkshire</option>
                        <option>Midlothian</option>
                        <option>Morayshire</option>
                        <option>Nairnshire</option>
                        <option>Orkney</option>
                        <option>Peeblesshire</option>
                        <option>Perthshire</option>
                        <option>Renfrewshire</option>
                        <option>Ross-shire</option>
                        <option>Roxburghshire</option>
                        <option>Selkirkshire</option>
                        <option>Shetland</option>
                        <option>Stirlingshire</option>
                        <option>Sutherland</option>
                        <option>West Lothian</option>
                        <option>Wigtownshire</option>
                    </optgroup>
                    <optgroup label="Wales">
                        <option>Anglesey</option>
                        <option>Brecknockshire</option>
                        <option>Caernarfonshire</option>
                        <option>Carmarthenshire</option>
                        <option>Cardiganshire</option>
                        <option>Denbighshire</option>
                        <option>Flintshire</option>
                        <option>Glamorgan</option>
                        <option>Merioneth</option>
                        <option>Monmouthshire</option>
                        <option>Montgomeryshire</option>
                        <option>Pembrokeshire</option>
                        <option>Radnorshire</option>
                    </optgroup>
                    <optgroup label="Northern Ireland">
                        <option>Antrim</option>
                        <option>Armagh</option>
                        <option>Down</option>
                        <option>Fermanagh</option>
                        <option>Londonderry</option>
                        <option>Tyrone</option>
                    </optgroup>
                </select>
            </div>

                <div class="form-group">
                    <label for="postcode">postcode</label>
                    <input type="text" name="postcode" value="{{ old('postcode') }}" id="postcode" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Register details" class="btn btn-primary">
            </div>
        </form>
    </div>

    <div class="col-md-3 col-md-offset-2">
        <div class="row" style="margin-top: 100px">
        <a class="btn btn-success" href="/checkout/payment">Returning Customer? log in <a/>
        </div>
    </div>
@stop
