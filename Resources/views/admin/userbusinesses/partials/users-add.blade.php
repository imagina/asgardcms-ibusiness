<div id="searchUser">

    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{trans('ibusiness::userbusinesses.table.search the user')}}">
            <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat">{{trans('ibusiness::userbusinesses.button.asign user')}}</button>
        </span>
    </div>

    <div class="ui-widget">
        <label for="tags">Tags: </label>
        <input id="tags">
    </div>

</div>

<link href="{{url('modules/Dashboard/Assets/vendor/jquery-ui/themes/ui-lightness/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />


@push('js-stack')

<script src="{{ url('modules/Dashboard/Assets/vendor/jquery-ui/ui/autocomplete.js') }}"></script>

<script type="text/javascript">

    
    $(function(){ 

        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
            ];

        $( "#tags" ).autocomplete({
            source: availableTags
        });
       
    });

</script>


@endpush