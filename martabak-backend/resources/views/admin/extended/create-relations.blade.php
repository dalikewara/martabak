@if(count($contents->all()) != 0)
    <?php $a = 0; ?>
    @if($all == 'media')
        <div>
            @foreach($contents->where('type', 1)->orderBy('id', 'DESC')->get() as $content)
                <img id="addMedia-{{ $a }}" class="media-img-create-all createClick left pointer" src="{{ $dir->url('pictures') }}/{{ $content->file_name }}" value='<img title="{{ $content->meta_1 }}" src="{{ $dir->url("pictures") }}/{{ $content->file_name }}" alt="{{ $content->meta_3 }}">' />
                <?php $a++; ?>
            @endforeach
        </div>
    @elseif($all == 'tags')
        @foreach($contents->orderBy('id', 'DESC')->get() as $content)
            <input type="checkbox" name="{{ md5('tag') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}"><span class="relation-text">{{ $content->tag_name }}</span><br>
        @endforeach
    @elseif($all == 'categories')
        @foreach($contents->orderBy('id', 'DESC')->get() as $content)
            @if($content->default == 1)
                <input type="radio" name="{{ md5('category') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}" checked><span class="relation-text">{{ $content->category_name }}</span><br>
            @else
                <input type="radio" name="{{ md5('category') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}"><span class="relation-text">{{ $content->category_name }}</span><br>
            @endif

        @endforeach
    @endif
@else
    <h1 class="smoke text-center roboto empty-content">No content found.</h1>
@endif
