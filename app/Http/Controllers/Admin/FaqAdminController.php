<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqAdminController extends Controller
{
    public function index(){
        $faqs = Faq::all();
        return view('admin.faqs.manage', compact('faqs'));
    }

    public function create(){
        return view('admin.faqs.manage');
    }

    public function store(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::create($request->only('question', 'answer'));
        return redirect() -> route('admin.faqs.index') -> with('success', 'FAQ created succesfully');
    }

    public function edit($id){
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.index', compact('faq'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $faq = Faq::findorFail($id);
        $faq -> update($request->only('question', 'answer'));
        return redirect() -> route('admin.faqs.index') -> with('success', 'FAQ updated successfully');
    }

    public function destroy($id){
        $faq = Faq::findorFail($id);
        $faq -> destroy($id);
        return redirect() -> route('admin.faqs.index') -> with('success', 'FAQ deleted successfully');
    }
}
