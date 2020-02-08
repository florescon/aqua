<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Http\Requests\PageRequest;
use App\Http\Requests\PageUpdateRequest;

class CmsPageController extends Controller
{
   
    public function index()
    {
        $pages = CmsPage::orderBy('updated_at', 'desc')->where('type',1)->paginate();
        return view('backend.cms.support.index', compact('pages'));
    }


    public function indexPage()
    {
        $pages = CmsPage::orderBy('updated_at', 'desc')->where('type', 3)->paginate();
        return view('backend.cms.pages.index', compact('pages'));
    }

    public function store(PageRequest $request)
    {

        $this->validate($request, [
            'url_key'   => 'unique:title'
        ]);

        $page = new CmsPage();
        $page->url_key = $this->createSlug($request->title);
        $page->page_title = $request->title;
        $page->content = $request->content;
        $page->meta_title = $request->m_title;
        $page->meta_keywords = $request->m_keywords;
        $page->meta_description = $request->m_description;
        $page->type = 1;
        $page->save();

        return redirect()->route('admin.cms.support.index')
          ->withFlashSuccess('Pagina guardada con éxito');

    }


    public function storePage(PageRequest $request)
    {

        $this->validate($request, [
            'url_key'   => 'unique:title'
        ]);

        $page = new CmsPage();
        $page->url_key = $this->createSlug($request->title);
        $page->page_title = $request->title;
        $page->content = $request->content;
        $page->meta_title = $request->m_title;
        $page->meta_keywords = $request->m_keywords;
        $page->meta_description = $request->m_description;
        $page->type = 3;
        $page->save();

        return redirect()->route('admin.cms.pages.index')
          ->withFlashSuccess('Pagina guardada con éxito');

    }

    public function edit($id)
    {
        $page = CmsPage::findOrFail($id);
        return view('backend.cms.support.edit', compact('page'));

    }

    public function editPage($id)
    {
        $page = CmsPage::findOrFail($id);
        return view('backend.cms.pages.edit', compact('page'));

    }

    public function update(PageUpdateRequest $request)
    {

        $type = CmsPage::findOrFail($request->id);
        $type->update($request->all());

        return redirect()->route('admin.cms.support.index')
          ->withFlashSuccess('Pagina actualizada con éxito');
    }

    public function updatePage(PageUpdateRequest $request)
    {

        $type = CmsPage::findOrFail($request->id);
        $type->update($request->all());

        return redirect()->route('admin.cms.pages.index')
          ->withFlashSuccess('Pagina actualizada con éxito');
    }

    public function destroy($id)
    {
        try {
            $type = CmsPage::findOrFail($id);
            $type->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }

        return redirect()->route('admin.cms.support.index')->withFlashSuccess('Pagina eliminada con éxito');
    }

    public function destroyPage($id)
    {
        try {
            $type = CmsPage::findOrFail($id);
            $type->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }

        return redirect()->route('admin.cms.pages.index')->withFlashSuccess('Pagina eliminada con éxito');
    }

    //For Generating Unique Slug Our Custom function
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('url_key', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('url_key', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return CmsPage::select('url_key')->where('url_key', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

}
