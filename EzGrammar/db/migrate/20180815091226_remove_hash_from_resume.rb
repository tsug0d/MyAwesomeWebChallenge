class RemoveHashFromResume < ActiveRecord::Migration[5.2]
  def change
    remove_column :resumes, :hash, :string
  end
end
