@if($course->hasSalarySection())
    <div class="rounded border border-2 p-3 d-flex my-5" style="border-color: #FD5529 !important;">
        <div class="align-self-center">
            <img src="/images/inauka2/salary.png"/>
        </div>
        <div class="align-self-center flex-grow-1 border-right p-1">
            <div class="subtitle-2" style="color: #FF6841">
                Wynagrodzenie:
            </div>
            <div class="font-sora" style="font-size: 32px; font-weight: 600">
                {{ $course->salary_range }}
            </div>
            <div class="font-sora">
                {{ $course->salary_skills }}
            </div>
        </div>
        <div class="align-self-center">
            <a href="{{ $course->salary_cta }}"
               target="_blank"
               class="btn btn-white"
               style="font-size: 16px">

                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                    <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                        <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                              transform="translate(191 252)" fill="none"/>
                        <path id="Path_4140" data-name="Path 4140"
                              d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                              transform="translate(206.672 262)" fill="currentColor"/>
                    </g>
                </svg>
                Zobacz oferty
            </a>
        </div>
    </div>
@endif
