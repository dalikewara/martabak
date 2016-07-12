<div class="auto box-relation">
    @foreach($tables->all() as $table)
        @if(in_array($table->id, $meta1Lists))
            @if($content == 'category')
                <input type="radio" name="{{ md5($content) }}" value="{{ md5($table->id) }}" checked><span class="relation-text">{{ $table->$name }}</span><br>
            @else
                <input type="checkbox" name="{{ md5($content) }}-{{ md5('relation') }}-{{ md5($table->id) }}" value="{{ md5($table->id) }}" checked><span class="relation-text">{{ $table->$name }}</span><br>
            @endif
        @endif
    @endforeach
    <div class="relation-separate"></div>
    <span class="smoke"><small><i>Availabe to be related.</i></small></span>
    <br>
    @foreach($tables->all() as $table)
        @if(!in_array($table->id, $meta1Lists))
            @if($content == 'category')
                <input type="radio" name="{{ md5($content) }}" value="{{ md5($table->id) }}"><span class="relation-text">{{ $table->$name }}</span><br>
            @else
                <input type="checkbox" name="{{ md5($content) }}-{{ md5('relation') }}-{{ md5($table->id) }}" value="{{ md5($table->id) }}"><span class="relation-text">{{ $table->$name }}</span><br>
            @endif
        @endif
    @endforeach
</div>
