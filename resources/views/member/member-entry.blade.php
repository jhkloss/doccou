<span class="tag is-large">
    <strong>{{ $member->name }}</strong>
    <small>{{ $member->email }}</small>
    @if($canEdit)
        <button class="delete delete-member" data-userid="{{ $member->id }}"></button>
    @endif()
</span>
