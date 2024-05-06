<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2 z-[99] max-w-4xl mx-auto w-full">
    <div class="max-w-7xl mx-auto px-6 ">
        <div class="px-6 py-4 rounded-lg bg-[#1d1929]">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="w-0 flex-1 items-center hidden md:inline">
                    <div class="flex items-center gap-4">
                        <img src="/images/cookie_icon.svg" class="w-10 h-10 object-fit">
                        <p class="ml-3 flex-1 text-white cookie-consent__message">
                            {!! trans('cookie-consent::texts.message') !!}
                        </p>
                    </div>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-white bg-primary hover:bg-primary">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
