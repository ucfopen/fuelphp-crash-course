<?php

class Controller_Comments extends Controller_Template
{

	public function action_edit($id = null, $message_id = null)
	{
		$comment = Model_Comment::find($id);
		if (Input::post())
		{
			$comment->name = Input::post('name');
			$comment->comment = Input::post('comment');
			$comment->message_id = $message_id;
			if ($comment->save())
			{
				Session::set_flash('success', 'Updated comment #'.$id);
				Response::redirect('messages/view/'.$comment->message_id);
			}
			else
			{
				Session::set_flash('error', 'Could not update comment #'.$id);
			}
		}
		else
		{
			$this->template->set_global('comment', $comment, false);
		}
		$this->template->title = 'Comments &raquo; Edit';
		$this->template->content = View::forge('comments/edit');
	}

	public function action_create($id = null)
	{
		if (Input::post())
		{
			$comment = Model_Comment::forge(array(
				'name' => Auth::instance()->get_screen_name(),
				'comment' => Input::post('comment'),
				'id' => $id,
			));
			
			if ($comment and $comment->save())
			{
				Session::set_flash('success', 'Added comment #'.$comment->id.'.');
				Response::redirect('messages/view/'.$comment->message_id);
			}
			else
			{
				Session::set_flash('error', 'Could not save comment.');
			}
		}
		else
		{
			$this->template->set_global('message', $id, false);
		}
	 
		$this->template->title = 'Comments &raquo; Create';
	 
		$views = array();
		$views['form'] = View::forge('comments/_form');
	 
		$this->template->content = View::forge('comments/create', $views);
	}

	public function action_delete($id, $message_id)
	{
		if ($comment = Model_Comment::find($id))
		{
			$comment->delete();
			Session::set_flash('success', 'Deleted comment #'.$id);
		}
		else
		{
			Session::set_flash('error', 'Could not delete comment #'.$id);
		}
		Response::redirect('messages/view/'.$message_id);
	}

}
