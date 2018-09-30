class AddUserToResume < ActiveRecord::Migration[5.2]
  def change
    add_column :resumes, :user, :string
  end
end
