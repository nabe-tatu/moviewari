@extends('layouts.app')

@section('content')
    <h1>映画館編集</h1>
   <theter-delete></theter-delete>
@endsection
<script>
    import TheterDelete from "../js/components/TheterDelete";
    export default {
        components: {TheterDelete}
    }
</script>
