<x-guest-layout>
    <x-auth-card>
        <ul class="list-disc">
            @foreach($words as $word)
                <li>{{$word}}</li>
            @endforeach
        </ul>
    </x-auth-card>
</x-guest-layout>

