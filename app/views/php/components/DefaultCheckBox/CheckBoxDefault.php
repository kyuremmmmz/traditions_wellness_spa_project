<?php

namespace Project\App\Views\Php\Components\DefaultCheckBox;

class CheckBoxDefault
{
    // HUWAG NIYO LALAGYAN NG SWITCH CASE AYOKO SA CANTON CODE
    public static function render(?string $className = null, ?string $name, ?string $value, ?string $content): void
    {
        echo <<<HTML
            <div class="flex flex-col gap-[12px] ml-24 min-w-[260px] max-w-[260px]">
                <div class="flex flex-row gap-[12px] items-center">
                    <p class="leading-none BodyTwo text-onBackground dark:text-darkOnBackground text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Add-ons</p>
                    <div class="flex flex-col gap-[12px] min-w-[260px] max-w-[260px]">
                        <div class="flex items-start gap-[12px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px] w-full bg-background dark:bg-darkBackground">
                            <input id="hot_stone" type="checkbox" name="hot_stone" value="150" class="w-[16px] h-[16px] bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo accent-primary dark:accent-darkPrimary rounded-[4px]">
                            <div class="flex flex-col gap-[8px] w-full">
                                <label for="hot_stone" class="leading-none BodyTwo text-onBackground dark:text-darkOnBackground">Hot Stone Therapy</label>
                                <div class="flex gap-[8px]">
                                    <p class="leading-none CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo">+ 30 mins</p>
                                    <p class="leading-none CaptionOne text-primary dark:text-darkPrimary">₱150</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start gap-[12px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px] w-full bg-background dark:bg-darkBackground">
                            <input id="swedish" type="checkbox" name="swedish" value="200" class="w-[16px] h-[16px] bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo accent-primary dark:accent-darkPrimary rounded-[4px]">
                            <div class="flex flex-col gap-[8px] w-full">
                                <label for="swedish" class="leading-none BodyTwo text-onBackground dark:text-darkOnBackground">Swedish Massage</label>
                                <div class="flex gap-[8px]">
                                    <p class="leading-none CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo">+ 60 mins</p>
                                    <p class="leading-none CaptionOne text-primary dark:text-darkPrimary">₱200</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start gap-[12px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px] w-full bg-background dark:bg-darkBackground">
                            <input id="deep" type="checkbox" name="deep_tissue" value="180" class="w-[16px] h-[16px] bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo accent-primary dark:accent-darkPrimary rounded-[4px]">
                            <div class="flex flex-col gap-[8px] w-full">
                                <label for="deep" class="leading-none BodyTwo text-onBackground dark:text-darkOnBackground">Deep Tissue Massage</label>
                                <div class="flex gap-[8px]">
                                    <p class="leading-none CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo">+ 45 mins</p>
                                    <p class="leading-none CaptionOne text-primary dark:text-darkPrimary">₱180</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}