<div class="table-responsive">
    @if($course->shouldShowLessonPreview())
        <table class="table course-table table-bordered">
            <thead>
            <tr>
                <th>Lekcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->visibleLessons()->get() as $lesson)
                <tr>
                    <td>
                        <div class="table-col1">
                            <div class="lecture-txt">Lekcja
                                <span>{{ $lesson->pivot->position+1 }}</span>
                                <a target="_blank" href="{{ $lesson->previewLink() }}"
                                   class="preview">Podgląd</a>
                            </div>
                            {{ $lesson->title }}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($course->isSpecialAccess())
            <p>Ten kurs może zawierać więcej lekcji, które nie są w tej chwili widoczne.</p>
        @endif
    @else
        <p>Podgląd lekcji dla tego kursu nie jest dostępny.</p>
    @endif
</div>
