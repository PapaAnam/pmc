@if(config('app.button_type') == 'text')<div class="col-md-12"><button class="btn btn-warning {{ config('app.button_size') == 'default' ? '' :  'btn-'.config('app.button_size')}}" onclick="hapusD(this, event)">{{ config('app.delete_button') }}</button></div>@else<div class="col-md-12"><button class="btn btn-warning {{ config('app.button_size') == 'default' ? '' :  'btn-'.config('app.button_size')}}" onclick="hapusD(this, event)"><i class="material-icons">{{ config('app.delete_button') }}</i></button></div>@endif