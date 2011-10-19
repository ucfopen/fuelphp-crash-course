<?php

class Controller_Comments extends Controller_Template {

	public function action_edit($id = null, $mid = null)
	{
		$comment = Model_Comment::find($id);
		if (Input::method() == 'POST')
		{
			$comment->name = Auth::instance()->get_screen_name();
			$comment->comment = Input::post('comment');
			$comment->mid = $mid;
			if ($comment->save())
			{
				Session::set_flash('notice', 'Updated comment #' . $id);
				Response::redirect('messages/view/'.$comment->mid);
			}
			else
			{
				Session::set_flash('notice', 'Could not update comment #' . $id);
			}
		}
		else
		{
			$this->template->set_global('comment', $comment, false);
		}
		$this->template->title = "Comments";
		$this->template->content = View::factory('comments/edit');
	}

	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$comment = Model_Comment::factory(array(
				'name' => Auth::instance()->get_screen_name(),
				'comment' => Input::post('comment'),
				'mid' => Input::post('mid'),
			));
			if ($comment and $comment->save())
			{
				Session::set_flash('notice', 'Added comment #' . $comment->id . '.');
				Response::redirect('messages/view/'.$id);
			}
			else
			{
				Session::set_flash('notice', 'Could not save comment.');
			}
		}
		else
		{
			$this->template->set_global('message', $id, false);
		}
		$this->template->title = "Comments";
		$this->template->content = View::factory('comments/create');
	}
	
	public function action_delete($id, $mid)
	{
		if ($comment = Model_Comment::find($id))
		{
			$comment->delete();
			Session::set_flash('notice', 'Deleted comment #' . $id);
		}
		else
		{
			Session::set_flash('notice', 'Could not delete comment #' . $id);
		}
		Response::redirect('messages/view/'.$mid);
	}
}

/* End of file comments.php */