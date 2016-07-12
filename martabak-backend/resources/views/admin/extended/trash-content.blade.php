<div class="trash-header">
    <h5 class="text-center"><span class="glyphicon glyphicon-trash orange"></span><strong> Trash</strong></h5>
</div>
<div id="trash-inner" class="section auto">
    @if($totalTrash > 0)
        <div class="auto trash-section">
            <?php $b = 1; ?>
            @foreach($trashes as $trash)
                <div class="auto trash-content">
                    <div class="left">
                        <span>{{ $totalTrash }}. </span>
                        @if($trash->type == 'post' OR $trash->type == 'page')
                            <span>{{ $trash->meta_3 }} </span>
                        @else
                            <span>{{ $trash->meta_2 }} </span>
                        @endif
                    </div>
                    <div class="right">
                        <form id="form-remove-trash-{{ $b }}" role="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="{{ md5('trash') }}-{{ md5($trash->id) }}" value="{{ md5($trash->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('trash') }}">
                            <input type="hidden" name="{{ md5('trash-type') }}" value="{{ md5($content) }}">
                        </form>
                        <form id="form-restore-trash-{{ $b }}" role="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="{{ md5('trash') }}-{{ md5($trash->id) }}" value="{{ md5($trash->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRestore') }}">
                            <input type="hidden" name="{{ md5('trash-type') }}" value="{{ md5($content) }}">
                        </form>
                        <span title="Remove this" class="process-button right red trash-remove click" value="{{ $b }}-remove-trash"><span class="glyphicon glyphicon-remove"></span></span>
                        <span title="Restore this" class="process-button right green trash-restore click" value="{{ $b }}-restore-trash"><span class="glyphicon glyphicon-refresh"></span></span>
                        <br>
                        <div id="child-content-tasks-trash-{{ $b }}" class="text-right right">
                        </div>
                    </div>
                </div>
                <?php $totalTrash--; ?>
                <?php $b++; ?>
            @endforeach
        </div>
        <div class="auto">
            <h5 title="Remove all" class="process-button trash-remove-all right click" value="all-remove-trash-all"><span class="glyphicon glyphicon-remove"></span>Remove all</h5>
            <h5 title="Restore all" class="process-button trash-restore-all right click" value="all-restore-trash-all"><span class="glyphicon glyphicon-refresh"></span>Restore all</h5>
            <form id="form-remove-trash-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('trash') }}">
                <input type="hidden" name="{{ md5('trash-type') }}" value="{{ md5($content) }}">
            </form>
            <form id="form-restore-trash-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRestore') }}">
                <input type="hidden" name="{{ md5('trash-type') }}" value="{{ md5($content) }}">
            </form>
        </div>
        <div id="child-content-tasks-trash-all-all" class="text-right">
        </div>
    @else
        <h1 class="smoke text-center roboto empty-content">Trash is empty.</h1>
    @endif
</div>
