<header class="bg-blue-950 fixed top-0 inset-x-0 z-10">
    <div class="container flex justify-between items-center py-5 text-white">
        <a href="{{ route('home') }}" class="text-md sm:text-xl font-semibold">Автошкола</a>

        <nav class="hidden lg:block">
            <ul class="flex gap-8 text-[18px] font-semibold">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-orange-400 hover:border-b-2">
                        Главная
                    </a>

                </li>
                <li>
                    <a href="#" class="boredr hover:text-orange-400 hover:border-b-2"
                    >ПДД</a
                    >
                </li>
                <li>
                    <a href="{{ route('posts.index') }}" class="boredr hover:text-orange-400 hover:border-b-2"
                    >Блог</a
                    >
                </li>
                <li>
                    <a href="#" class="boredr hover:text-orange-400 hover:border-b-2"
                    >Онлайн тест</a
                    >
                </li>
                <li>
                    <a href="faq.html" class="boredr hover:text-orange-400 hover:border-b-2"
                    >Справка FAQ</a
                    >
                </li>
            </ul>
        </nav>

        <div class="sm:flex gap-4 font-semibold text-white hidden">
            <a
                href=""
                class="flex items-center px-5 py-2 bg-orange-400 rounded-xl hover:bg-white hover:text-black"
            >Регистрация</a
            >
            <a
                href=""
                class="flex items-center px-5 py-2 bg-orange-400 rounded-xl hover:bg-white hover:text-black"
            >Войти</a
            >
        </div>

        <div class="flex lg:hidden">
            <nav
                id="nav"
                class="absolute inset-x-0 top-full bg-blue-950 py-4 text-center hidden target:block peer"
            >
                <ul
                    class="flex flex-col items-center gap-8 text-[18px] font-semibold"
                >
                    <li class="w-full">
                        <a href="#" class="inline-block w-full">Главная</a>
                    </li>
                    <li class="w-full">
                        <a href="#" class="inline-block w-full">ПДД</a>
                    </li>
                    <li class="w-full">
                        <a href="#" class="inline-block w-full">Блог</a>
                    </li>
                    <li class="w-full">
                        <a href="#" class="inline-block w-full">Онлайн тест</a>
                    </li>
                    <li class="w-full">
                        <a href="#" class="inline-block w-full">Справка FAQ</a>
                    </li>
                </ul>
                <div
                    class="flex sm:hidden flex-col items-center gap-4 font-semibold mt-5"
                >
                    <a
                        href=""
                        class="w-35 px-5 py-2 bg-orange-400 rounded-xl hover:bg-white hover:text-black"
                    >Регистрация</a
                    >
                    <a
                        href=""
                        class="text-center w-35 px-5 py-2 bg-orange-400 rounded-xl hover:bg-white hover:text-black"
                    >Войти</a
                    >
                </div>
            </nav>

            <a
                href="#nav"
                class="block peer-target:hidden peer-target:[&+a]:block"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="size-7"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd"
                    />
                </svg>
            </a>

            <a href="#" class="hidden">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="size-6"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd"
                    />
                </svg>
            </a>
        </div>
    </div>
</header>
