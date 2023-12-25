@if($comment->count())
    @foreach($comment as $value)
        @if($value->title != '')
            <script type="application/ld+json">
                {
              "@context": "https://schema.org",
              "@type": "QAPage",
                "mainEntity": {
                "@type": "Question",
                "name": "{{ $value->title == '' ? $query->title : $value->title }}",
                "text": "{{ $value->text }}",
                "answerCount": {{$value->child->count()}},
                "upvoteCount": {{ $value->vote }},
                "dateCreated": "{{ $value->created_at->format('Y-m-d\TH') }}",
                "author": {
                  "@type": "Person",
                  "name": "{{ $value->name }}"
                },
                @if($value->childaccept != null)
                    @include('temp.answer_accept_json',['accept' => $value->childaccept])
                @endif
                "suggestedAnswer": [
                    @include('temp.answer_json',['data' => $value->child])
                ]
              }
           }
        </script>
        @endif
    @endforeach
@endif
