<?php
class Controller_Comments extends Controller_Template
{
	public function action_edit($id = null, $mid = null)
	{
		$comment = Model_Comment::find($id);
		if(Input::method() == 'POST')
		{
			$comment->name = Input::post('name');
			$comment->comment = Input::post('comment');
			$comment->mid = $mid;
			if($comment->save())
			{
				Session::set_flash('success', 'Updated comment #' . $id);
				Response::redirect('comments/edit/'.$comment->id);
			}
			else
			{
				Session::set_flash('error', 'Could not update comment #' . $id);
			}
		}
		else
		{
			$this->template->set_global('comment', $comment, false);
		}
		$this->template->title = 'Comments';
		$this->template->content = View::forge('comments/edit');
	}
	public function action_create($id=null)
	{
		if(Input::method()=='POST')
		{
			echo "controller";
			$comment = Model_Comment::factory(array(
				'name' => Auth::instance()->get_screen_name(),
				'comment' => Input::post('comment'),
				'mid' => $id,
			));
			if($comment and $comment->save())
			{
				Session::set_flash('success', 'Added comment #' . $comment->id . '.');
				Response::redirect('messages/view/'.$comment->mid);
			}
			else
			{
				Session::set_flash('error', 'Could not save comment.');
			}
		}
		else
		{
			$this->template->set_global('mid',$id,false);
		}
		$this->template->title = 'Comments';
		$this->template->content = View::forge('comments/create');
	}
	public function action_delete($id, $mid)
	{
		if($comment = Model_Comment::find($id))
		{
			$comment->delete();
			Session::set_flash('success', 'Deleted comment #' . $id);
		}
		else
		{
			Session::set_flash('error', 'Could not delete comment #' . $id);
		}
		Response::redirect('messages/view/'.$mid);
	}
}
