


<x-guest-layout>
<x-auth-card>
    <x-slot name="logo">

    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">话题</div>
                    <div class="panel-body">
                        <ul>
                        @foreach($books as $topic)
                            <li>
                                <div>
                                <a href="/notice/{{ $topic->id }}">
                                    <h4>{{ $topic->title }}</h4>
                                </a>
                                </div>
                                <div class="body">{{ $topic->content }}</div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-card>
</x-guest-layout>
