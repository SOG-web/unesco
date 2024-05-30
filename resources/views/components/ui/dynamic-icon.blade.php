@props(['icon' => 'student', 'active' => false])

@switch($icon)
    @case('students')
        <x-icons.student :active="$active"/>
        @break
    @case('courses')
        <x-icons.courses :active="$active"/>
        @break
    @case('teachers')
        <x-icons.teachers :active="$active"/>
        @break
    @default
        <x-icons.student :active="$active"/>
        @break
@endswitch

