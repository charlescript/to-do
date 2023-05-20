
    <button
        type="{{ ($type =='submit')?'submit':'reset'}}"
        class="{{ $type=='submit' ? 'btn btn-primary' : 'btn' }}">
        {{$slot}}
    </button>

