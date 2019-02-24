@extends('main')

@section('css')
	<link rel="stylesheet" href="{{url('design')}}/css/api.css"/>
@endsection

@section('content')
        <div class="container">
        	<div class="head">
        		<h1>Getting Started</h1>
        	</div>
        	<div class="contents">
        		<h1>Contents</h1>
        		<hr>
        		<ul>
        			<li><a href="#Requests">Requests</a></li>
        			<li><a href="#Authentication">Authentication</a></li>
        				<ul>
        					<li><a href="#Accesstoken">Login & Access token</a></li>
        					<li><a href="#Userinfo">User info</a></li>
        					<li><a href="#Logout">Logout</a></li>
        				</ul>
        			<li><a href="#News">News</a></li>
        				<ul>
        					<li><a href="#Getnews">Get all news</a></li>
        				</ul>
        			<li><a href="#Posts">Posts</a></li>
        				<ul>
        					<li><a href="#newpost">Add new post</a></li>
        					<li><a href="#Likepost">Like & Unlike post</a></li>
        				</ul>
        			<li><a href="#Users">Users</a></li>
        				<ul>
        					<li><a href="#Getinfo">Get user info</a></li>
        					<li><a href="#Getpics">Get user pics</a></li>
        				</ul>
        			<li><a href="#">Notifications</a></li>
        				<ul>
        					<li><a href="#Getnoti">Get all notifications</a></li>
        					<li><a href="#Countnoti">Count your notifications</a></li>
        					<li><a href="#Updatenoti">Update notifications</a></li>
        				</ul>
        		</ul>
        	</div>
        	<div id="Requests" class="Requests">
        		<h1>Requests</h1>
        		<p>You need to make header requests "Accept: application/json" to recive response as json</p>
        	</div>
        	<hr>
        	<div id="Authentication" class="Authentication">
        		<h1>Authentication</h1>
        		<h2 id="Accesstoken">- Login & Access token:</h2>
        		<p>
        			You need to login with post method with fields {username}, {password} and {rememberme} if you want to keep app remember you
        		</p>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        				<th>Fields</th>
        			</tr>
        			<tr>
        				<td>POST</td>
        				<td>{{ $url }}login</td>
        				<td>{username} {password} {rememberme:boolean}</td>
        			</tr>
        		</table>
        		<p>After login you will recive your access token to enter all api's</p>
        		<table>
        			<tr>
        				<th>Field</th>
        				<th>Description</th>
        			</tr>
        			<tr>
        				<td>access_token</td>
        				<td>your access token to enter all api's</td>
        			</tr>
        			<tr>
        				<td>token_type</td>
        				<td>the type of your token</td>
        			</tr>
        			<tr>
        				<td>expires_at</td>
        				<td>the time life for your token</td>
        			</tr>
        		</table>
        		<h2 id="Userinfo">- User info:</h2>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}loggedUser</td>
        			</tr>
        		</table>
        		<h2 id="Logout">- Logout:</h2>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}logout</td>
        			</tr>
        		</table>
        	</div>
        	<hr>
        	<div id="News" class="News">
        		<h1>News</h1>
        		<h2 id="Getnews">- Get all news:</h2>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}getnews</td>
        			</tr>
        		</table>
        	</div>
        	<hr>
        	<div id="Posts" class="Posts">
        		<h1>Posts</h1>
        		<h2 id="Addpost">- Add new post:</h2>
        		<p>When you send your new post data you need to send 2 fields {image} required field and must be an image & {cmnt} the comment on pic but not required</p>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        				<th>Fields</th>
        			</tr>
        			<tr>
        				<td>POST</td>
        				<td>{{ $url }}new_post</td>
        				<td>{image:required} {cmnt:optional}</td>
        			</tr>
        		</table>
        		<h2 id="Likepost">- Like & Unlike post:</h2>
        		<p>you need to send the id of focused picture - if you already liked it the app will unlike the same picture automaticlly</p>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        				<th>Fields</th>
        			</tr>
        			<tr>
        				<td>POST</td>
        				<td>{{ $url }}like</td>
        				<td>{id:required}</td>
        			</tr>
        		</table>
        	</div>
        	<hr>
        	<div id="Users" class="Users">
        		<h1>Users</h1>
        		<p>just add Username in {id} to see user info</p>
        		<h2 id="Getinfo">- Get user info:</h2>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        				<th>Fields</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}get_info/{id}</td>
        				<td>{id:required}</td>
        			</tr>
        		</table>
        		<h2 id="Getpics">- Get user pics:</h2>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        				<th>Fields</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}get_pics/{id}</td>
        				<td>{id:required}</td>
        			</tr>
        		</table>
        	</div>
        	<hr>
        	<div id="NotificationsAPI" class="NotificationsAPI">
        		<h1>Notifications</h1>
        		<h2 id="Getnoti">- Get all notifications:</h2>
        		<p>get latest notifications in the list</p>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}noti_get</td>
        			</tr>
        		</table>
        		<h2 id="Countnoti">- Count your notifications:</h2>
        		<p>this API count if any new notification didn't seen before</p>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        			</tr>
        			<tr>
        				<td>GET</td>
        				<td>{{ $url }}noti_counter</td>
        			</tr>
        		</table>
        		<h2 id="Updatenoti">- Update notifications:</h2>
        		<p>use notifications update to update notifications as readed if user saw them</p>
        		<table>
        			<tr>
        				<th>Request</th>
        				<th>URL</th>
        			</tr>
        			<tr>
        				<td>POST</td>
        				<td>{{ $url }}noti_update</td>
        			</tr>
        		</table>
        	</div>
        </div>
@endsection
    