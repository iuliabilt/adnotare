@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-12">
                <blockquote>
                    <p id="loading">Se încarcă...</p>
                    <p id="fileText" style="white-space: pre-wrap; display: none;">{{ $fileContent }}</p>
                    <footer>{{ $author }} - <cite title="Source Title">{{ $file->name }}</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="commentTitle">Adnotări</h4>
        </div>
        <div class="modal-body">
          <p id="adnotariText">Se încarcă...</p>
        </div>
        <div class="modal-footer">
            <input type="hidden" id="wordIdInput">
            <textarea type="text" class="form-control" id="content" placeholder="Introduceți o adnotare..." name="content"></textarea>
            <button type="submit" id="addCommentBtn" class="custm-btn btn-primary">Adaugă adnotare</button>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
$(function() {
    var words = $("#fileText").text().split("<wordtag>");
    $("#fileText").empty();
    $.each(words, function(i, v) {
        //$("#fileText").append($("<span>").text(v));
        $("#fileText").append($("<span>").text(v).addClass("wordClick").attr("id",i));
    });
    $('#loading').hide();
    $("#fileText").show();

    $.ajax({
        url: "{{ url('get_comments_ids') }}",
        type: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "file_id": "{{ $file->id }}"
        },
        dataType: "json",
        async: "false",
        success: function(success_var) {
            $.each(success_var, function(k, v) {
                $("#"+v).css('font-weight', 'bold');
            });
        },
        error: function(error_var) {
            console.log(error_var);
        }
    });

    $(".wordClick").click(function(){
        $("#commentTitle").html("Adnotări pentru cuvântul: <b>" + $(this).text() + "</b>");
        $("#wordIdInput").val($(this).attr('id'));
        $.ajax({
            url: "{{ url('get_comments') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "file_id": "{{ $file->id }}",
                "word_id": $("#wordIdInput").val()
            },
            dataType: "json",
            success: function(success_var) {
                console.log(success_var);
                htmlCommets = "";
                $.each(success_var, function(index, element) {
                    // htmlCommets += "<div class\"col-md-12\">";
                    htmlCommets += element.content;
                    htmlCommets += "<br><br>";
                    // htmlCommets += "</div>";

                    // alert(element.content); 
                });
                $("#adnotariText").html(htmlCommets);
            },
            error: function(error_var) {
                console.log(error_var);
            }
        });
        //alert($(this).attr('id'));
        $("#myModal").modal();
    });

    $("#addCommentBtn").click(function(){
        $.ajax({
            url: "{{ route('comment.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "file_id": "{{ $file->id }}",
                "user_id": "{{ Auth::user()->id }}",
                "word_id": $("#wordIdInput").val(),
                "content": $("#content").val()
            },
            dataType: "json",
            success: function(success_var) {
                $("#myModal").modal('hide');
                $("#content").val('');
                $("#"+$("#wordIdInput").val()).css('font-weight', 'bold');
                // alert("Success");
            },
            error: function(error_var) {
                console.log(error_var);
            }
        });
    });
});
</script>
@endsection
