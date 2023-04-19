<a href="{{route('besluit.dislike', $decision)}}">
    @if($color)
        <i class="fa-solid fa-circle-xmark text-red-900"></i>
    @else
        <i class="fa-solid fa-circle-xmark text-gray-900"></i>
    @endif
</a>
