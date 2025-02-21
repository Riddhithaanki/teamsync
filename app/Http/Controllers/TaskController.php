namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::whereIn('role', ['developer', 'tech_lead'])->get();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'assigned_to' => 'required|exists:users,id'
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully');
    }
}
