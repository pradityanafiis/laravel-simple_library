<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    private $memberRepository;

    public function __construct()
    {
        $this->memberRepository = new MemberRepository();
    }

    public function index()
    {
        $data = $this->memberRepository->getAll();
        return view('member.index', ['data' => $data]);
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:members'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
        ]);

        $data = $request->only(['name', 'gender', 'phone']);

        if ($this->memberRepository->create($data)) {
            return redirect()->back()->with('success_message', 'Member created!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to create member!');
        }
    }

    public function show(Member $member)
    {
        //
    }

    public function edit(Member $member)
    {
        return view('member.edit', ['member' => $member]);
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('members', 'name')->ignore($member->id)],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
        ]);

        $data = $request->only(['name', 'gender', 'phone']);

        if ($this->memberRepository->update($data, $member->id)) {
            return redirect()->route('member.index')->with('success_message', 'Member created!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to update member!');
        }
    }

    public function destroy(Member $member)
    {
        if ($this->memberRepository->delete($member->id)) {
            return redirect()->back()->with('success_message', 'Member deleted!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to delete member!');
        }
    }
}
