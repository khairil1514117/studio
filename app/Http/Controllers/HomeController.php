<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Dummy data: ganti dengan Eloquent (Project::all()) nanti.
        $projects = [
            ['id'=>1,'title'=>'Project One','category'=>'Visual Campaign','year'=>2026,'image'=>'projects/work-01.jpg','video'=>null,'description'=>'Kampanye visual dengan nuansa sinematik.','span'=>'md:col-span-7 aspect-[4/3]'],
            ['id'=>2,'title'=>'Project Two','category'=>'Event Documentation','year'=>2026,'image'=>'projects/work-02.jpg','video'=>null,'description'=>'Dokumentasi event dari awal hingga akhir.','span'=>'md:col-span-5 md:mt-32 aspect-[3/4]'],
            ['id'=>3,'title'=>'Project Three','category'=>'Creative Film','year'=>2025,'image'=>'projects/work-03.jpg','video'=>null,'description'=>'Film pendek tentang cerita yang bertahan.','span'=>'md:col-span-12 aspect-[21/9]'],
            ['id'=>4,'title'=>'Project Four','category'=>'Documentary','year'=>2025,'image'=>'projects/work-04.jpg','video'=>null,'description'=>'Dokumenter perjalanan dan manusia.','span'=>'md:col-span-4 aspect-square'],
            ['id'=>5,'title'=>'Project Five','category'=>'Commercial','year'=>2025,'image'=>'projects/work-05.jpg','video'=>'videos/reel.mp4','description'=>'Konten komersial berbasis video.','span'=>'md:col-span-8 aspect-video'],
        ];
        $gallery = [];
        $cats = ['photo','video','event','bts'];
        for ($i = 1; $i <= 8; $i++) {
            $gallery[] = ['title'=>"Frame 0$i",'category'=>$cats[$i % 4],'image'=>sprintf('gallery/gallery-%02d.jpg',$i),'ratio'=>['aspect-[3/4]','aspect-square','aspect-[4/5]','aspect-[4/3]'][$i % 4]];
        }
        $activities = array_map(fn($i)=>['n'=>sprintf('%02d',$i),'image'=>sprintf('images/activity-%02d.jpg',$i)], range(1,5));
        $services = ['Photography','Videography','Event Documentation','Creative Campaign','Social Media Content','Visual Production'];
        $socials = ['Instagram'=>'#','YouTube'=>'#','Facebook'=>'#','TikTok'=>'#','LinkedIn'=>'#'];
        return view('home', compact('projects','gallery','activities','services','socials'));
    }
}
