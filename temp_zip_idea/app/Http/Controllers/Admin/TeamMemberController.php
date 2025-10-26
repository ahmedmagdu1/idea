<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->latest('id')->paginate(12);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        $member = new TeamMember();
        return view('admin.team.create', compact('member'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('team', 'public');
        }

        // اجعل sort_order آخر واحد إذا لم يرسل
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = (int) (TeamMember::max('sort_order') + 1);
        }

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'تم إضافة العضو بنجاح');
    }

    public function edit(TeamMember $team)
    {
        $member = $team;
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $this->validated($request, $team->id);

        if ($request->hasFile('photo')) {
            if ($team->photo_path) Storage::disk('public')->delete($team->photo_path);
            $data['photo_path'] = $request->file('photo')->store('team', 'public');
        }

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'تم تحديث بيانات العضو');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo_path) Storage::disk('public')->delete($team->photo_path);
        $team->delete();
        return back()->with('success', 'تم حذف العضو');
    }


 
    public function getPhotoUrlAttribute(): string
    {
        // تحقق إذا كان حقل 'photo' يحتوي على قيمة وأن الملف موجود فعلاً
        // يفترض هذا الكود أن الصور محفوظة في 'storage/app/public'
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            return Storage::url($this->photo);
        }

        // في حال عدم وجود صورة، أرجع صورة افتراضية لمنع ظهور خطأ
        // تأكد من وجود صورة افتراضية في المسار public/images/default-avatar.png
        return asset('images/default-avatar.png');
    }



private function validated(Request $request, $id = null): array
{
    $rules = [
        'name'         => ['required','string','max:255'],
        'title'        => ['nullable','string','max:255'],
        'department'   => ['nullable','string','max:255'],
        'email'        => ['nullable','email','max:255'],
        'phone'        => ['nullable','string','max:30'],
        'linkedin_url' => ['nullable','url','max:255'],
        'bio'          => ['nullable','string','max:5000'],
        'sort_order'   => ['nullable','integer','min:0'],
        'is_active'    => ['nullable'], // شلنا boolean
        'photo'        => [$id ? 'nullable' : 'nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
    ];
    $data = $request->validate($rules);

    // نحول القيمة لـ Boolean
    $data['is_active'] = $request->boolean('is_active');

    return $data;
}

}
