<?php
class Controller_Messages extends Controller_Template {
	
	public function action_index()
	{
		$view = View::factory('messages/index');
		$messages = Model_Message::find('all');
		$comments = array();
		foreach ($messages as $message)
		{
			$query = Model_Comment::find()->where("mid", $message['id']);
			$comments[$message['id']] = $query->count();
			if ($comments[$message['id']] == 1)
			{
				$comments[$message['id']] .= " Comment";
			}
			else if($comments[$message['id']] == 0)
			{
				$comments[$message['id']] = "View";
			}
			else
			{
				$comments[$message['id']] .= " Comments";
			}
		}
		$view->set('comments', $comments);
		$view->set('messages', $messages);
		$this->template->title = "Messages";
		$this->template->content = $view;
	}
	
	public function action_view($id = NULL)
	{
		$data['message'] = Model_Message::find($id);
		$comments = Model_Comment::find()->where('mid', $id)->get();
		$data['comments'] = $comments;
		$this->template->title = "Message";
		$this->template->content = View::factory('messages/view', $data);
	}
	
	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$message = Model_Message::factory(array(
				'name' => Auth::instance()->get_screen_name(),
				'message' => Input::post('message'),
			));

			if ($message and $message->save())
			{
				Session::set_flash('notice', 'Added message #' . $message->id . '.');

				Response::redirect('messages');
			}

			else
			{
				Session::set_flash('notice', 'Could not save message.');
			}
		}

		$this->template->title = "Messages";
		$this->template->content = View::factory('messages/create');

	}
	
	public function action_edit($id = null)
	{
		$message = Model_Message::find($id);

		if (Input::method() == 'POST')
		{
			$message->name = Auth::instance()->get_screen_name();
			$message->message = Input::post('message');

			if ($message->save())
			{
				Session::set_flash('notice', 'Updated message #' . $id);

				Response::redirect('messages');
			}

			else
			{
				Session::set_flash('notice', 'Could not update message #' . $id);
			}
		}
		
		else
		{
			$this->template->set_global('message', $message, false);
		}
		
		$this->template->title = "Messages";
		$this->template->content = View::factory('messages/edit');

	}
	
	public function action_delete($id = null)
	{
		if ($message = Model_Message::find($id))
		{
			$message->delete();
			
			Session::set_flash('notice', 'Deleted message #' . $id);
		}

		else
		{
			Session::set_flash('notice', 'Could not delete message #' . $id);
		}

		Response::redirect('messages');

	}
	
	
}

/* End of file messages.php */
