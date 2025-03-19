<?php

namespace Project\App\Views\Php\Components\Inputs;

class StaticRadioButton
{
    public static function render(?string $className = null): void
    {
        echo <<<HTML
        <div class="flex flex-col pb-[48px]">
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Service. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What will be booked?');
                            ?>
                        </div>
                        <div id="select" class="flex flex-col gap-[16px] FieldContainer min-w-[316px] w-full max-w-[400px]">

                        </div>
                        <div class="space-y-4">
                            <!-- Item 1 -->
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="1"
                                    name="body_massage"
                                    value="150"
                                    class="peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo checked:border-borderHighlight dark:checked:border-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] appearance-none cursor-pointer focus:ring-0 checked:shadow-blue-500/10 relative before:content-[''] before:absolute before:left-2 before:top-1/2 before:-translate-y-1/2 before:w-6 before:h-6 before:rounded-full before:bg-transparent before:scale-0 checked:before:content-['✓'] checked:before:bg-borderHighlight dark:checked:before:bg-darkBorderHighlight checked:before:scale-100 before:flex before:items-center before:justify-center before:text-white before:text-lg before:transition-all before:duration-200" />
                                <label
                                    for="1"
                                    id="1-label"
                                    class="transition-all ease-in-out absolute BodyOne left-[40px] mt-[10px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo peer-checked:text-onBackground dark:peer-checked:text-darkOnBackground dark:bg-darkBackground bg-background px-[7px] pointer-events-none">
                                    Body massage (+30 mins)   ₱150.00
                                </label>
                            </div>

                            <!-- Item 2 -->
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="2"
                                    name="body_scrub"
                                    value="150"
                                    class="peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo checked:border-borderHighlight dark:checked:border-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] appearance-none cursor-pointer focus:ring-0 checked:shadow-blue-500/10 relative before:content-[''] before:absolute before:left-2 before:top-1/2 before:-translate-y-1/2 before:w-6 before:h-6 before:rounded-full before:bg-transparent before:scale-0 checked:before:content-['✓'] checked:before:bg-borderHighlight dark:checked:before:bg-darkBorderHighlight checked:before:scale-100 before:flex before:items-center before:justify-center before:text-white before:text-lg before:transition-all before:duration-200" />
                                <label
                                    for="2"
                                    id="2-label"
                                    class="transition-all ease-in-out absolute BodyOne left-[40px] mt-[10px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo peer-checked:text-onBackground dark:peer-checked:text-darkOnBackground dark:bg-darkBackground bg-background px-[7px] pointer-events-none">
                                    Body scrub (+30 mins)         ₱150.00
                                </label>
                            </div>
                            <!-- Item 2 -->
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="2"
                                    name="hotstone"
                                    value="150"
                                    class="peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo checked:border-borderHighlight dark:checked:border-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] appearance-none cursor-pointer focus:ring-0 checked:shadow-blue-500/10 relative before:content-[''] before:absolute before:left-2 before:top-1/2 before:-translate-y-1/2 before:w-6 before:h-6 before:rounded-full before:bg-transparent before:scale-0 checked:before:content-['✓'] checked:before:bg-borderHighlight dark:checked:before:bg-darkBorderHighlight checked:before:scale-100 before:flex before:items-center before:justify-center before:text-white before:text-lg before:transition-all before:duration-200" />
                                <label
                                    for="2"
                                    id="2-label"
                                    class="transition-all ease-in-out absolute BodyOne left-[40px] mt-[10px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo peer-checked:text-onBackground dark:peer-checked:text-darkOnBackground dark:bg-darkBackground bg-background px-[7px] pointer-events-none">
                                    Hotstone (+30 mins)    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; ₱150.00
                                </label>
                            </div>
                            <!-- Item 2 -->
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="2"
                                    name="earcandling"
                                    value="150"
                                    class="peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo checked:border-borderHighlight dark:checked:border-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] appearance-none cursor-pointer focus:ring-0 checked:shadow-blue-500/10 relative before:content-[''] before:absolute before:left-2 before:top-1/2 before:-translate-y-1/2 before:w-6 before:h-6 before:rounded-full before:bg-transparent before:scale-0 checked:before:content-['✓'] checked:before:bg-borderHighlight dark:checked:before:bg-darkBorderHighlight checked:before:scale-100 before:flex before:items-center before:justify-center before:text-white before:text-lg before:transition-all before:duration-200" />
                                <label
                                    for="2"
                                    id="2-label"
                                    class="transition-all ease-in-out absolute BodyOne left-[40px] mt-[10px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo peer-checked:text-onBackground dark:peer-checked:text-darkOnBackground dark:bg-darkBackground bg-background px-[7px] pointer-events-none">
                                    Earcandling (+30 mins)    &nbsp; &nbsp; ₱150.00
                                </label>
                            </div>
                        </div>
                    </div>
        HTML;
    }
}