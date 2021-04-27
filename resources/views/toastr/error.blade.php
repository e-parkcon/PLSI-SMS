@if(count($errors) > 0)
    <?php $counter = 0; ?>
    @foreach($errors->all() as $error)
      $.notify({
        message: '{{$error}}' 
      },{
        type: 'danger',
        offset:{
          x:20,
          y:60
        },
        delay: 5000,
        timer: {{$counter*250 + 5000}}
      });
      <?php $counter=$counter+1; ?>
    @endforeach
  @endif
  
  @if(session('success'))
    $.notify({
      message: '{{session('success')}}' 
    },{
      type: 'success',
      offset:{
          x:20,
          y:60
        },
      delay: 5000,
    });
  @endif

  @if(session('error'))
    $.notify({
      message: '{{session('error')}}' 
    },{
      type: 'danger',
      offset:{
          x:20,
          y:60
        },
      delay: 5000,
    });
  @endif

  @if(session('warning'))
    $.notify({
      message: '{{session('warning')}}' 
    },{
      type: 'warning',
      offset:{
          x:20,
          y:60
        },
      delay: 5000,
    });
  @endif