<template>
    <div class="modal fade" id="logbookModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Aktywność użytkownika</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <timeline-entry
                        v-for="entry in timeline"
                        v-bind:key="entry.timestamp"
                        :entry="entry"></timeline-entry>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TimelineEntry from "./TimelineEntry";

export default {
    name: "Logbook",

    components: {
        'timeline-entry': TimelineEntry
    },

    data() {
        return {
            timeline: [],
            entries: [],
            lessons: [],
            logbooks: [],
            course: null
        };
    },

    methods: {
        open(user, course) {
            console.log(user, course);
            axios.get('/admin/courses/logbook?user_id=' + user + '&course_id=' + course)
                .then(data => {
                    console.log(data.data);

                    this.entries = data.data.entries;
                    console.log(this.entries);
                    this.logbooks = data.data.logbooks;
                    this.lessons = data.data.lessons;
                    this.course = data.data.pivot;

                    this.createTimeline();

                    $('#logbookModal').modal('show');
                });
        },

        createTimeline() {

            this.addTimelineItem(this.course.created_at, "Rozpoczęto kurs");

            if (this.course.finished_at)
                this.addTimelineItem(this.course.finished_at, "Zakończono kurs");

            this.entries.forEach((entry) => {
                console.log(entry);
                this.addTimelineItem(
                    entry.created_at,
                    '<h5>Logbook: ' + entry.title + '</h5><p>' + entry.description + '</p>',
                    entry
                );
            });

            this.lessons.forEach((lesson) => {
                this.addTimelineItem(lesson.created_at, 'Rozpoczęto lekcję ' + lesson.lesson.title);

                if (lesson.finished_at)
                    this.addTimelineItem(lesson.finished_at, 'Ukończono lekcję ' + lesson.lesson.title);
            });

            this.sort();
        },

        addTimelineItem(date, content, entry = null) {
            this.timeline.push({
                date: date,
                content: content,
                timestamp: (new Date(date)).getTime(),
                entry: entry,
            });
        },

        sort() {
            this.timeline.sort(function (a, b) {
                if (a.timestamp > b.timestamp)
                    return 1;

                if (a.timestamp < b.timestamp)
                    return -1;

                return 0;
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
