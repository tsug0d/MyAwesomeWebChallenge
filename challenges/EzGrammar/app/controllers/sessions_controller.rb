class SessionsController < ApplicationController

  skip_before_action :require_login, only: [:new, :create]
  
  def new
  end

  def create
  	user = User.find_by name: params[:session][:name].downcase
  	if user && user.authenticate(params[:session][:password])
  		flash[:success]="Login success"
  		log_in user
  		redirect_to users_path
  	else
  		flash[:danger]="Something Wrong"
  		render :new
  	end
  end

  def destroy
  	log_out
  	flash[:success]="You're Logged out"
  	redirect_to login_path
  end
end