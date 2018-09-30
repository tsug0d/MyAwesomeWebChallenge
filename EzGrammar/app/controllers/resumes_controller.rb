class ResumesController < ApplicationController
   def index
      if params[:type].present? && avoid_error(params[:type])
         type=params[:type]
      else
         type="ASC"
      end
      @resumes = Resume.all.where(user: current_user.name).order("`resumes`.`name` #{type}")
   end
   
   def new
      @resume = Resume.new
   end
   
   def create
      @resume = Resume.new(resume_params)
      @resume.user=@current_user.name
      if @resume.attachment.present?
         if @resume.save
            @resume.update_attributes(hashfile: hash_calc(create_valid_upload_link(@resume.attachment_url)) )
            redirect_to resumes_path, notice: "The resume #{@resume.name} has been uploaded."
         else
            render "new"
         end
      else
         render "new"
      end
   end
   
   def destroy
      @resume = Resume.where(user: current_user.name).find(params[:id])
      @resume.destroy
      redirect_to resumes_path, notice:  "The resume #{@resume.name} has been deleted."
   end
   
   private
      def resume_params
      params.require(:resume).permit(:name, :attachment)
   end
   
end