<span class="tag is-large is-white">
    <strong>{{ $member->name }}</strong>
    <small>{{ $member->email }}</small>
    @if($canEdit)
        <button class="delete delete-member" data-userid="{{ $member->id }}"></button>
    @endif()
</span>
