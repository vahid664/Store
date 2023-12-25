@foreach($data as $value)
    @if($loop->last)
    {
        "@type": "Answer",
        "text": "{{ $value->text }}",
        "dateCreated": "{{ $value->created_at->format('Y-m-d\TH') }}",
        "upvoteCount": {{ $value->vote }},
        "url": "{{ url()->current() }}#comment{{$value->id}}",
        "author": {
            "@type": "Person",
            "name": "{{ $value->name }}"
        }
    }
    @else
        {
        "@type": "Answer",
        "text": "{{ $value->text }}",
        "dateCreated": "{{ $value->created_at->format('Y-m-d\TH') }}",
        "upvoteCount": {{ $value->vote }},
        "url": "{{ url()->current() }}#comment{{$value->id}}",
        "author": {
        "@type": "Person",
        "name": "{{ $value->name }}"
        }
        },
    @endif
@endforeach
