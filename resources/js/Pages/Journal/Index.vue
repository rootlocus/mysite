<template>
    <Head title="Journal"/>
    <div class="bg-black h-full flex flex-col justify-top items-center pt-20">
        <div class="w-full text-center">
            <h1 class="text-white title text-8xl">Journal</h1>
            <div class="flex flex-col justify-center items-center mx-136">
                <span class="text-white hidden">found 200 search results</span>
                <input type="text" name="min" placeholder="Search" class="border border-gray-400 rounded-xl p-2 m-2 w-full">
            </div>
        </div>

        <div class="bg-white my-5 p-4 px-8 mx-60 rounded" v-for="y in x" :key="y">
            <h2 class="title font-bold text-3xl">No, motherfucker</h2>
            <h3 class="content font-medium"><i>20 Jan 2021</i> | By Eric Heng</h3>
            <p class="mt-2">Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, 'cause I'll kill the motherfucker, know what I'm sayin'?
You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.
Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you. But I can't give you this case, it don't belong to me. Besides, I've already been through too much shit this morning over this case to hand it over to your dumb ass.
Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
            </p>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
    },
    data() {
        return {
            x: [1,2,3,4]
        }
    },
}
</script>