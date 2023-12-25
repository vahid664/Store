"acceptedAnswer": {
    "@type": "Answer",
    "text": "{{ $accept->text }}",
    "dateCreated": "{{ $accept->created_at->format('Y-m-d\TH') }}",
    "upvoteCount": {{ $accept->vote }},
    "url": "{{ url()->current() }}#comment{{$accept->id}}",
    "author": {
        "@type": "Person",
        "name": "{{ $accept->name }}"
    }
},
