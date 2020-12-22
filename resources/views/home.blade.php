@extends('layouts.app')

@section('content')
    <main-page></main-page>
@endsection
<script>
    import MainPage from "../js/components/MainPage";
    export default {
        components: {MainPage}
    }
</script>
